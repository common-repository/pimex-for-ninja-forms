let mySubmitController = Marionette.Object.extend( {
    
    initialize: function() {
      this.listenTo( Backbone.Radio.channel( 'forms' ), 'submit:response', this.actionSubmit );
    },
  
    actionSubmit: function( response) {
        console.log(response);
        let fields = response.data.fields;
        let actions = response.data.actions;     
        
        searchDates(fields, actions, sendPimex);
        
    },
  
});

let searchDates = function(fields, actions, cb){
    let date;
    let dateCustom= {};
    let key = '';
    let data= {};
    let validKeys = ['name', 'nombre', 'email', 'correo', 'phone', 'telefono', 'subject', 'asunto', 'comment', 'comentario', 'message', 'mensaje'];
    let token;
    let id;


    if(actions.pimex){
        id = actions.pimex.id
        token = actions.pimex.token
    }


    for(i in fields){
        if(!fields[i].value) continue

        if(fields[i].key.indexOf('pmx-id') > -1){
            id = fields[i].value
            continue
        }

        if(fields[i].key.indexOf('pmx-token') > -1){
            token = fields[i].value
            continue
        }

        if(validKeys.indexOf(fields[i].key) > -1 || validKeys.indexOf(fields[i].label) > -1){
            key = validKeys[validKeys.indexOf(fields[i].key)];
            date = fields[i].value;
            data[key]= date;
            continue
        }

        key = 'custom';
        dateCustom[fields[i].key] = fields[i].value
        date = dateCustom;  
        
        data[key]= date;
        console.log(data)
    }
    cb(data, id, token);

}

let sendPimex = function(data, id, token){  
    console.log(data)
    Pimex.async(data, {
        id: id,
        token: token
    },(err, res)=>{
        if(err) return console.log(err)

       console.log(res)
    })
}


new mySubmitController();
