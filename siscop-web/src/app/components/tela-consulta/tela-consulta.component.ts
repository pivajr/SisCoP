import {
  Component, ContentChild,
  Input,
  OnInit, TemplateRef,
} from '@angular/core';
import {Response} from "../../models/response";
import {Service} from "../../services/service";
import {lastValueFrom} from "rxjs";
import {fields} from "../../fields";

@Component({
    selector: 'scp-tela-consulta',
    templateUrl: './tela-consulta.component.html',
    styleUrls: ['./tela-consulta.component.scss']
})
export class TelaConsultaComponent implements OnInit {
    @Input()
    title: string;

    @Input()
    columns: { text: string, center?: boolean }[];

    @Input()
    service: Service<any>;

    @Input()
    totalPagesRange = 3;

    @Input()
    emptyMessage = 'Nenhum registro encontrado';

    @Input()
    loadingMessage = 'Carregando 🤪...';

    @ContentChild(TemplateRef)
    templateRef : TemplateRef<any>;

    resp: Response<any>;
    loading = false;

    datasource: any[] = [];

    async ngOnInit() {
      await this.loadPage(1);
    }

    getFieldName(field: string) {
      return fields.get(field) ?? field;
    }

    async loadPage(page: number) {
      this.loading = true;
      this.datasource = [];
      this.resp = await lastValueFrom(this.service.get(page));
      this.datasource = this.resp.data;
      this.loading = false;
    }

    getPagesRange() {
      let pages = [];

      for (let i = this.resp.meta.current_page - this.totalPagesRange; i < this.resp.meta.current_page; i++) {
        if (i >= 2) {
          pages.push(i);
        }
      }

      for (let i = this.resp.meta.current_page; i < this.resp.meta.current_page + this.totalPagesRange; i++) {
        if (i <= this.resp.meta.last_page - 1) {
          pages.push(i);
        }
      }

      return pages;
    }
}
