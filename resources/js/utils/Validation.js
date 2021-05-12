export default class Validation{
    constructor(){
        this.messages={};
    }

    getMessage(field){
        if(this.messages[field]){
            return this.messages[field][0];
        }
    }

    setMessages(message){
        this.messages = message;
    }

    empty(){
        this.messages={};
    }
}