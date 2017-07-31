export class Patient{
    id:number;
    first_name:string;
    last_name:string;
    other_name:string;
    dob:string;
    reg_date:string;
    personal_phone:string;
    work_phone:string;
    home_phone:string;
    address:string;
    city:string;
    house_number:string;
    email:string;
    gender_id:number;
    region_id:number;
    type_id:number;
    title_id:number;
    marital_status_id:number;
    status:number;
    created_at:string;
    updated_at:string;

    constructor(values: Object = {}) {
        Object.assign(this, values);
    }
}