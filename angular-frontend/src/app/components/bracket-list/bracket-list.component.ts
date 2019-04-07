import { Component, OnInit } from '@angular/core';
import {Bracket} from '../../models/bracket';
import {DataService} from '../../services/data-service/data.service';

@Component({
  selector: 'app-bracket-list',
  templateUrl: './bracket-list.component.html',
  styleUrls: ['./bracket-list.component.scss']
})
export class BracketListComponent implements OnInit {

  brackets: Bracket[];

  constructor(private data: DataService) { }

  ngOnInit() {
    this.data.getAllBrackets().subscribe(res => {
      this.brackets = res.response.response;
    });
  }

}
