export class PatientType {
	id:number;
	name:string;
	description:string;
	status:number;
	created_at:string;
	updated_at:string;

	constructor(values: Object = {}) {
        Object.assign(this, values);
    }
}