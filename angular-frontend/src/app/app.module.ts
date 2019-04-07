import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BracketListComponent } from './components/bracket-list/bracket-list.component';
import { BracketComponent } from './components/bracket/bracket.component';
import { BracketPreviewComponent } from './components/bracket-preview/bracket-preview.component';
import {MatCardModule, MatListModule, MatTableModule} from '@angular/material';

@NgModule({
  declarations: [
    AppComponent,
    BracketListComponent,
    BracketComponent,
    BracketPreviewComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    MatCardModule,
    MatTableModule,
    MatListModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
