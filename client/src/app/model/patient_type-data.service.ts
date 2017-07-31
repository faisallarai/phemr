import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';

import { Observable } from 'rxjs/Rx';

import { UserService } from './user.service';
import { GlobalService } from './global.service';
import { PatientType } from './patient_type';

@Injectable()
export class PatientTypeDataService {
	
	constructor (private _http:Http, private _userService:UserService, private _globalService:GlobalService) {

	}

	// GET /v1/patient-type
    getAllPatientTypes(): Observable<PatientType[]> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/patient-type?sort=-id',
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <PatientType[]>response.data;
            })
            .catch(this.handleError);
    }

    // GET /v1/patient-type/1
    getTitleById(id:number):Observable<PatientType> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/patient-type/'+id,
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <PatientType>response.data;
            })
            .catch(this.handleError);
    }

    private getHeaders():Headers {
    	return new Headers({
    		'Content-Type': 'application/json',
    		'Authorization': 'Bearer '+this._userService.getAccessToken(),
    	})
    }

    private handleError (error: Response | any) {

        let errorMessage:any = {};
        // Connection error
        if(error.status == 0) {
            errorMessage = {
                success: false,
                status: 0,
                data: "Sorry, there was a connection error occurred. Please try again.",
            };
        }
        else {
            errorMessage = error.json();
        }
        return Observable.throw(errorMessage);
    }
}