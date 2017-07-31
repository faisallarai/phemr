import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// Layouts
import { FullLayoutComponent } from './layouts/full-layout.component';
import { SimpleLayoutComponent } from './layouts/simple-layout.component';
import {P404Component} from './pages/404.component';

import {AuthGuard} from './model/auth.guard';

export const routes: Routes = [
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full',
  },
  {
    path: '',
    component: FullLayoutComponent,
    data: {
      title: 'Home'
    },
    canActivate: [AuthGuard],
    children: [
      {
        path: 'dashboard',
        loadChildren: './dashboard/dashboard.module#DashboardModule'
      },
      {
        path: 'components',
        loadChildren: './components/components.module#ComponentsModule'
      },
      {
        path: 'icons',
        loadChildren: './icons/icons.module#IconsModule'
      },
      {
        path: 'widgets',
        loadChildren: './widgets/widgets.module#WidgetsModule'
      },
      {
        path: 'charts',
        loadChildren: './chartjs/chartjs.module#ChartJSModule'
      },
      {
          path: 'user',
          loadChildren: 'app/user/user.module#UserModule'
      },
      {
          path: 'setting',
          loadChildren: 'app/setting/setting.module#SettingModule'
      },
      {
          path: 'patient',
          loadChildren: 'app/patient/patient.module#PatientModule'
      }
    ]
  },
  {
      path: '',
      component:SimpleLayoutComponent,
      children: [
          {
              path: 'login',
              loadChildren: 'app/login/login.module#LoginModule'
          },
          {
              path: 'logout',
              loadChildren: 'app/logout/logout.module#LogoutModule'
          },
          {
              path: 'signup',
              loadChildren: 'app/signup/signup.module#SignupModule'
          },
          {
              path: 'confirm',
              loadChildren: 'app/confirm/confirm.module#ConfirmModule'
          },
          {
              path: 'password-reset-request',
              loadChildren: 'app/password-reset-request/password-reset-request.module#PasswordResetRequestModule'
          },
          {
              path: 'password-reset',
              loadChildren: 'app/password-reset/password-reset.module#PasswordResetModule'
          }
      ],
  },
  {
    path: 'pages',
    component: SimpleLayoutComponent,
    data: {
      title: 'Pages'
    },
    children: [
      {
        path: '',
        loadChildren: './pages/pages.module#PagesModule',
      }
    ]
  }
];

@NgModule({
  imports: [ RouterModule.forRoot(routes) ],
  exports: [ RouterModule ]
})
export class AppRoutingModule {}
