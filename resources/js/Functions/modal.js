
export default class modalToggle {
    
    constructor() {
        this.heading = null,
        this.template = null,
        this.status = null
    } 


    open(e) {

        const data = e.target.dataset;

        this.heading = data.heading;
        this.template = data.template;
        this.status = 'open';

    }
    
}




