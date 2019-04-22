import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BracketListComponent } from './components/bracket-list/bracket-list.component';
import { BracketComponent } from './components/bracket/bracket.component';
import { BracketPreviewComponent } from './components/bracket-preview/bracket-preview.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {
  MatButtonModule,
  MatFormFieldModule,
  MatInputModule,
  MatSelectModule,
  MatCardModule,
  MatDividerModule
} from '@angular/material';
import { BracketGeneratorComponent } from './components/bracket-generator/bracket-generator.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { LoadingComponent } from './components/loading/loading.component';
import { GameComponent } from './components/game/game.component';
import { PlayerComponent } from './components/player/player.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { AboutComponent } from './components/about/about.component';
import { ContactComponent } from './components/contact/contact.component';

@NgModule({
  declarations: [
    AppComponent,
    BracketListComponent,
    BracketComponent,
    BracketPreviewComponent,
    BracketGeneratorComponent,
    LoadingComponent,
    GameComponent,
    PlayerComponent,
    NavbarComponent,
    AboutComponent,
    ContactComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    BrowserAnimationsModule,
    MatCardModule,
    MatButtonModule,
    MatFormFieldModule,
    MatInputModule,
    MatSelectModule,
    MatDividerModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
