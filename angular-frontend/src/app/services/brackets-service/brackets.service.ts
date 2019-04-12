import { Injectable } from '@angular/core';
import {Bracket} from '../../models/bracket';
import {DataService} from '../data-service/data.service';

@Injectable({
  providedIn: 'root'
})
export class BracketsService {

  public brackets: Bracket[];

  constructor(private data: DataService) { }

  public loadFromServer(): void {
    this.data.getAllBrackets().subscribe(res => {
      this.brackets = res.response.response;
    });
  }

  public async addBracket(name: string, playerCount: number): Promise<boolean> {
    if (this.bracketNameExists(name)) {
      return false;
    }
    const resp = await this.data.createBracket(name, playerCount).toPromise();
    const newBracket: Bracket = resp.response.response;
    console.log(newBracket);
    this.brackets.push(newBracket);
    console.log(newBracket);
    return true;
  }

  public removeBracketById(id: number): boolean {
    this.brackets = this.brackets.filter(b => b.id !== id);
    return true;
  }

  private bracketNameExists(name: string): boolean {
    return this.brackets.findIndex(b => b.name === name) !== -1;
  }

}
