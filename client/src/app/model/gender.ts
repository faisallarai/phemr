export class Gender {
	id:number;
	name:string;
	description:string;
	created_at:string;
	updated_at:string;

	constructor(values: Object = {}){
		Object.assign(this,values);
	}
}