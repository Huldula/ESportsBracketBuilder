import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {BracketsService} from '../../services/brackets-service/brackets.service';

@Component({
  selector: 'app-bracket-generator',
  templateUrl: './bracket-generator.component.html',
  styleUrls: ['./bracket-generator.component.scss']
})
export class BracketGeneratorComponent implements OnInit {

  bracketForm = new FormGroup({
    name: new FormControl(''),
    playerCount: new FormControl('')
  });

  constructor(private bracketService: BracketsService) { }

  ngOnInit() {
  }

  public addBracket(): void {
    if (this.bracketForm.valid) {
      this.bracketService.addBracket(this.bracketForm.value.name, this.bracketForm.value.playerCount);
      this.bracketForm.reset();
    }
  }
}
