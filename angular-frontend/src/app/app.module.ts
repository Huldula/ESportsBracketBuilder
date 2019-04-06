import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MatchupComponent } from './components/matchup/matchup.component';
import { BracketListComponent } from './components/bracket-list/bracket-list.component';
import { BracketComponent } from './components/bracket/bracket.component';

@NgModule({
  declarations: [
    AppComponent,
    MatchupComponent,
    BracketListComponent,
    BracketComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
