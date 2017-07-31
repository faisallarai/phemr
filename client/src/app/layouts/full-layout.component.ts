import { Component, OnInit } from '@angular/core';
import { Subscription }   from 'rxjs/Subscription';

import { GlobalService } from '../model/global.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './full-layout.component.html'
})
export class FullLayoutComponent implements OnInit {

  public disabled = false;
  public status: {isopen: boolean} = {isopen: false};

  role:any;
  subscription: Subscription;

  constructor(private _globalService:GlobalService) {
    this.getRole();

    this.subscription = _globalService.userLoggedIn$.subscribe(
      data => {
       this.getRole();
    });
  }

  public getRole() {
    this.role = this._globalService.getRole();
    console.log("tie");
    console.log(this.role);
  }

  public toggled(open: boolean): void {
    console.log('Dropdown is now: ', open);
  }

  public toggleDropdown($event: MouseEvent): void {
    $event.preventDefault();
    $event.stopPropagation();
    this.status.isopen = !this.status.isopen;
  }

  ngOnInit(): void {}
}
