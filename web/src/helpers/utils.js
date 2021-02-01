function getPercentage(after, before) {
    return (((after - before) / before) * 100).toFixed(2);
}

function getClassColorValue(value, noColor) {
    value = parseFloat(value) || 0.00;

    if (noColor || value === 0.00) {
        return false;
    }

    return value < 0 ? {className: 'value-negative'} : {className: 'value-positive'};
}

function formatValue(value, format) {
    switch(format) {
        case 'decimal':
            value = parseFloat(value) || 0.00;
            return value.toLocaleString('pt-br', {style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2});
        case 'percent':
            value = parseFloat(value) || 0.00;
            return (value/100).toLocaleString('pt-br', {style: 'percent', minimumFractionDigits: 2, maximumFractionDigits: 2});
        case 'money':
            value = parseFloat(value) || 0.00;
            return value.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
        default:
            return value;
    }
}

const utils  = {
    getPercentage,
    getClassColorValue,
    formatValue,
};

export default utils