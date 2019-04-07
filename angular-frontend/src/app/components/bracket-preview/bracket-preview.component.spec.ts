import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BracketPreviewComponent } from './bracket-preview.component';

describe('BracketPreviewComponent', () => {
  let component: BracketPreviewComponent;
  let fixture: ComponentFixture<BracketPreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BracketPreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BracketPreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
