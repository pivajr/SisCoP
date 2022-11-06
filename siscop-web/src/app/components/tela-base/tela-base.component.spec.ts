import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TelaBaseComponent } from './tela-base.component';

describe('TelaBaseComponent', () => {
  let component: TelaBaseComponent;
  let fixture: ComponentFixture<TelaBaseComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TelaBaseComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(TelaBaseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
