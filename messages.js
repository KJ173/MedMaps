const moment=require('moment');

function formatMessage(username, text){
    return{
        username,
        text,
        time:moment().format('DD/MM/YYYY hh:mm a')
    };
}

module.exports = formatMessage;
