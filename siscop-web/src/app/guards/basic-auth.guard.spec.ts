import { TestBed } from '@angular/core/testing';

import { BasicAuthGuard } from './basic-auth.guard';

describe('BasicAuthGuard', () => {
  let guard: BasicAuthGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(BasicAuthGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
