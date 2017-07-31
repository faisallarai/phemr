import {Component, OnInit} from '@angular/core';
import {Router} from "@angular/router";
import swal, {SweetAlertOptions} from 'sweetalert2';

import {PatientDataService} from "../model/patient-data.service";
import {Patient} from "../model/patient";
import {UserService} from "../model/user.service";

@Component({
    templateUrl: './patient-list.component.html',
})
export class PatientListComponent implements OnInit{
    private _patients:Patient[];
    private _errorMessage:string;

    constructor(private _patientDataService:PatientDataService,
                private _userService:UserService,
                private _router:Router) {}

    ngOnInit() {
        this.getPatients();
    }

    public getPatients() {
        this._patients = null;
        this._patientDataService.getAllPatients()
            .subscribe(
                patients => {
                    this._patients = patients
                },
                error =>  {
                    // unauthorized access
                    if(error.status == 401) {
                        console.log("401");
                        this._userService.unauthorizedAccess(error);
                    } else {
                        this._errorMessage = error.data.message;
                    }
                }
            );
    }

    public viewPatient(patient:Patient):void {
        this._router.navigate(['/patient', patient.id]);
    }

    public confirmDeletePatient(patient:Patient):void {
        // Due to sweet alert scope issue, define as function variable and pass to swal

        let parent = this;
        // let getPatients = this.getPatients;
        this._errorMessage = '';

        swal({
            title: 'Are you sure?',
            text: "Once delete, you won't be able to revert this!",
            type: 'question',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    parent._patientDataService.deletePatientById(patient.id)
                        .subscribe(
                            result => {
                                parent.getPatients();
                                resolve();
                            },
                            error =>  {
                                // unauthorized access
                                if(error.status == 401) {
                                    console.log("not found");
                                    parent._userService.unauthorizedAccess(error);
                                } else {
                                    parent._errorMessage = error.data.message;
                                }
                                resolve();

                            }
                        );
                })
            }
        }).then(function(result) {
            // handle confirm, result is needed for modals with input

        }, function(dismiss) {
            // dismiss can be "cancel" | "close" | "outside"
        });
    }
}