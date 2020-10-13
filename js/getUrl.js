let getParams = function (orderForm) {

    let params = {},
        inputsToAppend = [],
        parser = window.location,
        query = parser.search.substring(1);

    if (query){
        let vars = query.split('&');

        //GET PARAMS
        for (let i = 0; i < vars.length; i++) {
            let pair = vars[i].split('=');
            params[pair[0]] = decodeURIComponent(pair[1]);
        }

        //CREATE INPUTS WITH PARAMS
        for (let key in params) {
            inputsToAppend.push(`<input type="hidden" name="${key}" value="${params[key]}">`);
        }

        //APPEND INPUTS TO FORM
        if (orderForm){
            inputsToAppend = inputsToAppend.join(' ');
            orderForm.append(`${inputsToAppend}`);
        }
    }

};

getParams($('.order_form'));