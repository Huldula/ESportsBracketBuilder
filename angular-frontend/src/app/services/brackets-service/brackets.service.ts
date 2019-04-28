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

  public async addBracket(name: string, playerCount: number): Promise<void> {
    if (this.bracketNameExists(name)) {
      return;
    }
    const resp = await this.data.createBracket(name, playerCount).toPromise();
    const newBracket: Bracket = resp.response.response;
    this.brackets.push(newBracket);
  }

  public removeBracketById(id: number): void {
    this.brackets = this.brackets.filter(b => b.id !== id);
    this.data.deleteBracket(id).subscribe();
  }

  public getBracketById(id: number): Bracket {
    for (const bracket of this.brackets) {
      if (bracket.id === id) {
        return bracket;
      }
    }
    return undefined;
  }

  public renameBracket(bracket: Bracket, newName: string): void {
    if (bracket.name !== newName) {
      bracket.name = newName;
      this.data.renameBracket(bracket.id, newName).subscribe();
    }
  }

  public shuffleBracketById(id: number): void {
    this.data.shuffleBracketById(id).subscribe(console.log);
  }

  public async setWinnerById(id: number): Promise<Bracket> {
    const resp = await this.data.setWinnerById(id).toPromise();
    if (!resp.response.response) {
      console.log(resp);
      return null;
    }
    for (let bracket of this.brackets) {
      if (bracket.id === resp.response.response.id) {
        bracket = resp.response.response;
      }
    }
    return resp.response.response;
  }

  private bracketNameExists(name: string): boolean {
    return this.brackets.findIndex(b => b.name.toUpperCase() === name.toUpperCase()) !== -1;
  }

}
