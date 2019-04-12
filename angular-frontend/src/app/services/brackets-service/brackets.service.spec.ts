import { TestBed } from '@angular/core/testing';

import { BracketsService } from './brackets.service';

describe('BracketsService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BracketsService = TestBed.get(BracketsService);
    expect(service).toBeTruthy();
  });
});
