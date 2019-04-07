import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {BracketListComponent} from './components/bracket-list/bracket-list.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: '/home',
    pathMatch: 'full'
  },
  {
    path: 'home',
    component: BracketListComponent
  },
  {
    path: 'bracket/:name',
    component: BracketListComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
