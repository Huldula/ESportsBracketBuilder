import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GameLayerComponent } from './game-layer.component';

describe('GameLayerComponent', () => {
  let component: GameLayerComponent;
  let fixture: ComponentFixture<GameLayerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GameLayerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GameLayerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
