import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EnderecoFieldsComponent } from './endereco-fields.component';

describe('EnderecoFieldsComponent', () => {
  let component: EnderecoFieldsComponent;
  let fixture: ComponentFixture<EnderecoFieldsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EnderecoFieldsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EnderecoFieldsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
