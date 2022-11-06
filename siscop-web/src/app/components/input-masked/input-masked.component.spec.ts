import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InputMaskedComponent } from './input-masked.component';

describe('InputMaskedComponent', () => {
  let component: InputMaskedComponent;
  let fixture: ComponentFixture<InputMaskedComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ InputMaskedComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InputMaskedComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
