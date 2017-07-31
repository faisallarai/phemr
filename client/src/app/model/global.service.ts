import {Injectable} from '@angular/core';
import * as moment from "moment";
import {environment} from '../../environments/environment';
import { Subject }    from 'rxjs/Subject';


@Injectable()
export class GlobalService{
    public apiHost:string;
    public role:any = 0;

    public setting:any = {};
    public patient:any = {};
    private userLoggedInSource = new Subject<string>();

    // Observable string streams
    userLoggedIn$ = this.userLoggedInSource.asObservable();

    constructor(){
        if(environment.production == true) {
            this.apiHost = 'http://api.phemr.local:8088/v1';
        } else {
            this.apiHost = 'http://api.phemr.local:8088/v1';
        }
    }

    loadGlobalSettingsFromLocalStorage():void{
        if(localStorage.getItem('setting') != null){
            this.setting = JSON.parse(localStorage.getItem('setting'));
        }
    }

    loadGlobalPatientsFromLocalStorage():void{
        if(localStorage.getItem('patient') != null){
            this.patient = JSON.parse(localStorage.getItem('patient'));
        }
    }

    getRole() {
        let role=JSON.parse(localStorage.getItem('role'));
       
        if(role != undefined) {
            this.role = role;
        }
        else{
            this.role = 0;
        }
        return this.role 
    }
}