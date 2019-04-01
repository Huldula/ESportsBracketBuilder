import { Component, OnInit } from '@angular/core';
import {DataService} from '../../services/data-service/data.service';

@Component({
  selector: 'app-matchup',
  templateUrl: './matchup.component.html',
  styleUrls: ['./matchup.component.scss']
})
export class MatchupComponent implements OnInit {

  constructor(private data: DataService) { }

  ngOnInit() {
    // this.data.getMatchUp().subscribe(console.log);
    this.data.createBracket('test0', 2).subscribe(console.log);
  }

}
