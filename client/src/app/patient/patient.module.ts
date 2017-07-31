import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {SharedModule} from '../shared/shared.module';

import {PatientListComponent} from './patient-list.component';
import {PatientFormComponent} from './patient-form.component';
import {PatientRoutingModule} from './patient-routing.module';

@NgModule({
    imports: [
        CommonModule,
        SharedModule,
        PatientRoutingModule,
    ],
    declarations: [
        PatientListComponent,
        PatientFormComponent,
    ]
})
export class PatientModule { }
