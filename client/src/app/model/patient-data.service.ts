import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/catch';
import {Observable} from 'rxjs/Rx';

import {GlobalService} from './global.service';
import {UserService} from './user.service';
import {Patient} from './patient';

@Injectable()
export class PatientDataService {

    constructor(private _http:Http,
                private _globalService:GlobalService,
                private _userService:UserService){
    }

    // POST /v1/patient
    addPatient(patient:Patient):Observable<any>{
        let headers = this.getHeaders();

        return this._http.post(
            this._globalService.apiHost+'/patient',
            JSON.stringify(patient),
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return response;
            })
            .catch(this.handleError);
    }

    // DELETE /v1/patient/1
    deletePatientById(id:number):Observable<boolean>{
        let headers = this.getHeaders();

        return this._http.delete(
            this._globalService.apiHost+'/patient/'+id,
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return response;
            })
            .catch(this.handleError);
    }

    // PUT /v1/patient/1
    updatePatientById(patient:Patient):Observable<any>{
        let headers = this.getHeaders();

        return this._http.put(
            this._globalService.apiHost+'/patient/'+patient.id,
            JSON.stringify(patient),
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return response;
            })
            .catch(this.handleError);
    }

    private getHeaders():Headers {
        console.log('access token');
        console.log(this._userService.getAccessToken());
        return new Headers({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this._userService.getAccessToken(),
        });
    }
    // GET /v1/patient
    getAllPatients(): Observable<Patient[]> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/patient?sort=-id',
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <Patient[]>response.data;
            })
            .catch(this.handleError);
    }

    // GET /v1/patient/1
    getPatientById(id:number):Observable<Patient> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/patient/'+id,
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <Patient>response.data;
            })
            .catch(this.handleError);
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

    public static getStatusTypes():Array<any>{
        return [
            {
                label: 'Active',
                value: 10
            },
            {
                label: 'Disabled',
                value: 0
            }
        ];
    }
}
