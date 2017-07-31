ERROR Error: Uncaught (in promise): Error: No provider for PatientDataService!
injectionError@http://localhost:4200/vendor.bundle.js:6110:90

Import PatientDataService in the app.module and add it to the providers

or exactly in the component it is called

@Component({
    templateUrl: './patient-form.component.html',
    providers: [TitleDataService, PatientTypeDataService]
})

ERROR Error: Uncaught (in promise): Error: Can't resolve all parameters for PatientTypeDataService: (?, ?, ?).

Add this @Injectable() to the PatientTypeDataService

