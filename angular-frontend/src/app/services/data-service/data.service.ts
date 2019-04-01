import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DataService {

  constructor(private http: HttpClient) { }

  public createBracket(name: string, size: number): Observable<any> {
    return this.http.post('/api/', {
      action: 'create',
      name,
      size
    });
  }

  public deleteBracket(id: number): Observable<any> {
    return this.http.post('/api/', {
      action: 'delete',
      id,
    });
  }

  public renameBracket(id: number, name: string): Observable<any> {
    return this.http.post('/api/', {
      action: 'rename',
      id,
      name
    });
  }

  public getBracket(id: number): Observable<any> {
    return this.http.post('/api/', {
      action: 'get',
      id,
    });
  }
}
