import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BracketListComponent } from './bracket-list.component';

describe('BracketListComponent', () => {
  let component: BracketListComponent;
  let fixture: ComponentFixture<BracketListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BracketListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BracketListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
