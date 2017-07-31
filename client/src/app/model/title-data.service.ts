import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';

import {Observable} from 'rxjs/Rx';

import { Title } from './title';
import { GlobalService } from './global.service';
import { UserService } from './user.service';


@Injectable()
export class TitleDataService {

	constructor(private _http: Http, private _globalService: GlobalService, private _userService: UserService ) {}

	// GET /v1/title
    getAllTitles(): Observable<Title[]> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/title?sort=-id',
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <Title[]>response.data;
            })
            .catch(this.handleError);
    }

    // GET /v1/title/1
    getTitleById(id:number):Observable<Title> {
        let headers = this.getHeaders();

        return this._http.get(
            this._globalService.apiHost+'/title/'+id,
            {
                headers: headers
            }
        )
            .map(response => response.json())
            .map((response) => {
                return <Title>response.data;
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