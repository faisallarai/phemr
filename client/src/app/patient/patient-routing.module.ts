import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {PatientListComponent} from './patient-list.component';
import {PatientFormComponent} from './patient-form.component';

const routes: Routes = [
    {
        path: '',
        data: {
            title: 'Patients'
        },
        children: [
            {
                path: 'list',
                component: PatientListComponent,
                data: {
                    title: 'List',
                }
            },
            {
                path: 'create',
                component: PatientFormComponent,
                data: {
                    title: 'Create'
                }
            },
            {
                path: ':id',
                component: PatientFormComponent,
                data: {
                    title: 'Update'
                }
            },
            {
                path: '',
                pathMatch: 'full',
                redirectTo: 'list'
            }
        ]
    }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule]
})
export class PatientRoutingModule {}
