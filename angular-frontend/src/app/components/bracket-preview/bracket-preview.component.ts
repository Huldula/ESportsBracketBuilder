import {Component, ElementRef, HostListener, Input, OnInit, ViewChild} from '@angular/core';
import {Bracket} from '../../models/bracket';
import {BracketsService} from '../../services/brackets-service/brackets.service';

@Component({
  selector: 'app-bracket-preview',
  templateUrl: './bracket-preview.component.html',
  styleUrls: ['./bracket-preview.component.scss']
})
export class BracketPreviewComponent implements OnInit {

  @Input()
  bracket: Bracket;

  @ViewChild('nameInput') nameInput: ElementRef;

  public isEditing: boolean;
  public tempName: string;

  constructor(private bracketsService: BracketsService) {
    this.isEditing = false;
  }

  ngOnInit() {
    this.tempName = this.bracket.name;
  }

  public removeBracket(): void {
    this.bracketsService.removeBracketById(this.bracket.id);
  }

  public edit(): void {
    this.isEditing = !this.isEditing;
    this.tempName = this.bracket.name;
    if (this.isEditing) {
      this.nameInput.nativeElement.focus();
    }
  }

  public saveChanges(): void {
    this.isEditing = false;
    this.bracketsService.renameBracket(this.bracket, this.tempName);
  }
}
