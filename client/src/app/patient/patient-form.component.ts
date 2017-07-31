import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from "@angular/router";
import {CustomValidators} from 'ng2-validation';
import {ContainsValidators} from "../shared/contains-validator.directive";
import {FormGroup, FormBuilder, Validators} from "@angular/forms";


import { PatientDataService } from "../model/patient-data.service";
import { Patient } from "../model/patient";

import { Title } from '../model/title';
import { TitleDataService } from "../model/title-data.service";

import { PatientType } from '../model/patient_type';
import { PatientTypeDataService } from '../model/patient_type-data.service';

import * as moment from "moment";

@Component({
    templateUrl: './patient-form.component.html',
    providers: [TitleDataService, PatientTypeDataService]
})
export class PatientFormComponent implements OnInit, OnDestroy{
    private _mode = '';

    private _id:number;
    private _parameters:any;
    private _patient:Patient;
    private _title:Title;
    private _patientType:PatientType;

    private _errorMessage:string;

    private _form:FormGroup;
    private _formErrors:any;
    private _submitted:boolean = false;

    private _statusTypes:any = {};
    public _titles: Title[];
    public _patientTypes: PatientType[];


    constructor(private _patientDataService:PatientDataService,
                private _titleDataService:TitleDataService,
                private _patientTypeDataService:PatientTypeDataService,
                private _router:Router,
                private _activatedRoute:ActivatedRoute,
                private _formBuilder:FormBuilder) {

        // Construct form group
        this._form = _formBuilder.group({
            title_id: [null, Validators.compose([
                Validators.required
            ])],
            first_name: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            last_name: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            other_name: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            city: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            address: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            house_number: ['', Validators.compose([
                Validators.required,
                CustomValidators.rangeLength([3, 15]),
                Validators.pattern('^[A-Za-z0-9_-]{3,15}$')
            ])],
            email: ['', Validators.compose([
                Validators.required,
                CustomValidators.email
            ])],
            gender_id: ['', Validators.compose([
                Validators.required
            ])],
            type_id: ['', Validators.compose([
                Validators.required
            ])],
            marital_status_id: ['', Validators.compose([
                Validators.required
            ])],
            region_id: ['', Validators.compose([
                Validators.required
            ])],
            personal_phone: ['', Validators.compose([
                Validators.minLength(10)
            ])],
            home_phone: ['', Validators.compose([
                Validators.required,
                Validators.minLength(10)
            ])],
            work_phone: ['', Validators.compose([
                Validators.minLength(10)
            ])],
            reg_date: ['', Validators.compose([])],
            dob: ['', Validators.compose([])],
            status: ['', Validators.compose([
                Validators.required,
                // Custom validator for checking value against list of values
                ContainsValidators.contains(['10','0'])
            ])],
        }, {
            validator: validateDateTime(['reg_date', 'dob'])
        });

        this._statusTypes = PatientDataService.getStatusTypes();
        this.getAllTitles();
        this.getAllPatientTypes();

        this._form.valueChanges
            .subscribe(data => this.onValueChanged(data));

    }

    //Get the list of titles  
  
    getAllTitles() {  
        this._titleDataService.getAllTitles().subscribe(res => this._titles = res, error => this._errorMessage = <any>error);  
    }  

    //Get the list of patient types  
  
    getAllPatientTypes() {  
        this._patientTypeDataService.getAllPatientTypes().subscribe(res => this._patientTypes = res, error => this._errorMessage = <any>error);  
    } 

    private _setFormErrors(errorFields:any):void{
        for (let key in errorFields) {
            let errorField = errorFields[key];
            // skip loop if the property is from prototype
            if (!this._formErrors.hasOwnProperty(errorField.field)) continue;

            // let message = errorFields[error.field];
            this._formErrors[errorField.field].valid = false;
            this._formErrors[errorField.field].message = errorField.message;
        }
    }

    private _resetFormErrors():void{
        this._formErrors = {
            first_name: {valid: true, message: ''},
            last_name: {valid: true, message: ''},
            other_name: {valid: true, message: ''},
            email: {valid: true, message: ''},
            personal_phone: {valid: true, message: ''},
            work_phone: {valid: true, message: ''},
            home_phone: {valid: true, message: ''},
            city: {valid: true, message: ''},
            address: {valid: true, message: ''},
            house_number: {valid: true, message: ''},
            reg_date: {valid: true, message: ''},
            title_id: {valid: true, message: ''},
            gender_id: {valid: true, message: ''},
            region_id: {valid: true, message: ''},
            marital_status_id: {valid: true, message: ''},
            type_id: {valid: true, message: ''},
            dob: {valid: true, message: ''},
            status: {valid: true, message: ''},
        };
    }

    private _isValid(field):boolean {
        let isValid:boolean = false;

        // If the field is not touched and invalid, it is considered as initial loaded form. Thus set as true
        if(this._form.controls[field].touched == false) {
            isValid = true;
        }
        // If the field is touched and valid value, then it is considered as valid.
        else if(this._form.controls[field].touched == true && this._form.controls[field].valid == true) {
            isValid = true;
        }
        return isValid;
    }

    public onValueChanged(data?: any) {
        if (!this._form) { return; }
        const form = this._form;
        for (let field in this._formErrors) {
            // clear previous error message (if any)
            let control = form.get(field);
            if (control && control.dirty) {
                this._formErrors[field].valid = true;
                this._formErrors[field].message = '';
            }
        }
    }

    private _resetPatient(){
        this._patient = new Patient();
        this._patient.first_name = '';
        this._patient.last_name = '';
        this._patient.other_name = '';
        this._patient.email = '';
        this._patient.personal_phone = '';
        this._patient.work_phone = '';
        this._patient.home_phone = '';
        this._patient.address = '';
        this._patient.city = '';
        this._patient.house_number = '';
        this._patient.dob = '';
        this._patient.reg_date = '';
        this._patient.status = 10;
    }

    public ngOnInit() {
        this._resetFormErrors();
        this._resetPatient();


        // _route is activated route service. this._route.params is observable.
        // subscribe is method that takes function to retrieve parameters when it is changed.
        this._parameters = this._activatedRoute.params.subscribe(params => {
            // plus(+) is to convert 'id' to number
            if(typeof params['id'] !== "undefined") {
                this._id = Number.parseInt(params['id']);
                this._errorMessage = "";
                this._patientDataService.getPatientById(this._id)
                    .subscribe(
                        patient => {
                            this._patient = patient;
                            this._mode = 'update';
                        },
                        error => {
                            // unauthorized access
                            if(error.status == 401) {
                                console.log("401");
                                // this._patientService.unauthorizedAccess(error);
                            } else {
                                this._errorMessage = error.data.message;
                            }
                        }
                    );
            } else {
                this._mode = 'create';

            }
        });
    }

    public ngOnDestroy() {
        this._parameters.unsubscribe();
        this._patient = new Patient();
    }

    public onSubmit() {
        this._submitted = true;
        this._resetFormErrors();
        if(this._mode == 'create') {
            this._patientDataService.addPatient(this._patient)
                .subscribe(
                    result => {
                        if(result.success) {
                            this._router.navigate(['/patient']);
                        } else {
                            this._submitted = false;
                        }
                    },
                    error => {
                        this._submitted = false;
                        // Validation errors
                        if(error.status == 422) {
                            this._setFormErrors(error.data);
                        }
                        // Unauthorized Access
                        else if(error.status == 401) {
                            console.log("401");
                            // this._patientService.unauthorizedAccess(error);
                        }
                        // All other errors
                        else {
                            this._errorMessage = error.data.message;
                        }
                    }
                );
        } else if(this._mode == 'update') {
            this._patientDataService.updatePatientById(this._patient)
                .subscribe(
                    result => {
                        if(result.success) {
                            this._router.navigate(['/patient']);
                        } else {
                            this._submitted = false;
                        }
                    },
                    error => {
                        this._submitted = false;
                        // Validation errors
                        if(error.status == 422) {
                            this._setFormErrors(error.data);
                        }
                        // Unauthorized Access
                        else if(error.status == 401) {
                            console.log("401");
                            // this._patientService.unauthorizedAccess(error);
                        }
                        // All other errors
                        else {
                            this._errorMessage = error.data.message;
                        }
                    }
                );
        }
    }
}

function validateDateTime(fieldKeys:any){
    return (group: FormGroup) => {
        for(let i = 0; i < fieldKeys.length; i++) {
            let field = group.controls[fieldKeys[i]];
            if(typeof field !== "undefined" && (field.value != "" && field.value != null)) {
                if(moment(field.value, "YYYY-MM-DD HH:mm:ss", true).isValid() == false) {
                    return field.setErrors({validateDateTime: true});
                }
            }
        }
    }
}