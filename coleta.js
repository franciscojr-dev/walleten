$(function() {
const content_card = `
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="tile">
            <div class="wrapper">
                <h5 class="card-title pt-2">{#ticker}</h5>
                <!--<h6 class="card-subtitle mb-2 text-muted">MAGAZINE LUIZA S.A.</h6>-->

                <div class="dates">
                    <div><strong>Quantidade</strong>{#qtd}<span></span></div>
                    <div><strong>Preço Médio</strong>R$ {#priceAvg}</div>
                    <div><strong>Montante Final</strong>{#total}<span></span></div>
                    <div><strong>Rentabilidade</strong><span class="text-success">{#rentPerc}%</span></div>
                </div>

                <!--
                <div class="stats">
                    <div><strong>Perc. Carteira</strong> {#percCart}%</div>
                    <div><strong>DY</strong> {#dy}%</div>
                    <div><strong>YOC</strong> {#yoc}%</div>
                </div>
                -->

                <div class="stats">
                    <div><strong>Máximo (dia)</strong> R$ {#maxDia}</div>
                    <div><strong>Mínimo (dia)</strong> R$ {#minDia}</div>
                    <div><strong>Cotação Atual</strong> R$ {#cotacao}</div>
                </div>

                <div class="stats" id="stats-geral">
                    <div><strong>Valorização (dia)</strong><span class="text-danger">R$ {#valorizacao}</span></div>
                    <div><strong>Variação R$ (dia)</strong><span class="text-danger">R$ {#valValor}</span></div>
                    <div><strong>Variação % (dia)</strong><span class="text-danger">{#valPerc}%</span></div>
                </div>

                <!--
                <div class="footer">
                    <a href="#" class="Cbtn Cbtn-primary">Visualizar</a>
                </div>
                -->
            </div>
        </div> 
    </div>
`;

    function replaceVars(content, data) {
        $.each(data, function(key, val) {
            content = content.replace('{#'+key+'}', val);
        });
        return content;
    }

    let totalDia = 0.00;
    let rentabilidadeDia = 0.00;

    $.getJSON('carteira.json', function(data) {
        let tickers = [];
        let data_tickers = {};

        $.each(data, function(key, val) {
            data_tickers[val.ticker] = val;
            tickers.push("BMFBOVESPA:"+val.ticker); 
        });

        let dataSend ={
            "columns": [
                "name",
                "description",
                "type",
                "open",
                "high",
                "close",
                "low",
                "change",
                "change_abs"
            ],
            "range": [
                0,
                tickers.length
            ],
            "symbols": {
                "tickers": tickers
            },
            "sort": {
                "sortBy": "name",
                "sortOrder": "asc"
            },
        };
        
        fetch('https://scanner.tradingview.com/brazil/scan', {
            method: 'post',
            body: JSON.stringify(dataSend)
        }).then(function(response) {
            return response.json();
        }).then(function(data) {
            $.each(data.data, function(key, valTk) {
                let val = data_tickers[valTk['d'][0]]
                let vars = {
                    ...val,
                    total: (valTk['d'][5] * val.qtd).toFixed(2),
                    rentPerc: (((valTk['d'][5] - val.priceAvg) / val.priceAvg) * 100).toFixed(2),
                    valorizacao: (valTk['d'][8] * val.qtd).toFixed(2),
                    maxDia: valTk['d'][4].toFixed(2),
                    cotacao: valTk['d'][5].toFixed(2),
                    minDia: valTk['d'][6].toFixed(2),
                    valPerc: valTk['d'][7].toFixed(2),
                    valValor: valTk['d'][8].toFixed(2),
                };
    
                let parser = new DOMParser();
                let parsedHtml = parser.parseFromString(content_card, 'text/html');
    
                parsedHtml.querySelector('.dates div:nth-child(4) span').attributes.class.value = (vars.rentPerc < 0 ? 'text-danger' : 'text-success');
                parsedHtml.querySelector('#stats-geral div:nth-child(1) span').attributes.class.value = (vars.valorizacao < 0 ? 'text-danger' : 'text-success');
                parsedHtml.querySelector('#stats-geral div:nth-child(2) span').attributes.class.value = (vars.valValor < 0 ? 'text-danger' : 'text-success');
                parsedHtml.querySelector('#stats-geral div:nth-child(3) span').attributes.class.value = (vars.valPerc < 0 ? 'text-danger' : 'text-success');
    
                let content = parsedHtml.body.innerHTML;
    
                $('.container-fluid .row').append(replaceVars(content, vars));
    
                rentabilidadeDia += parseFloat(vars.valorizacao);
                totalDia += parseFloat(vars.total);
                
            });

            $('#resumo-dia').html(`
                <h3>Montante Total: <strong>${totalDia.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</strong></h3>
                <h3>Variação Dia: <strong>${rentabilidadeDia.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</strong></h3>
            `);
        });
    });
});