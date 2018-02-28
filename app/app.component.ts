import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  forms: FormGroup;
  students: any;
  constructor (
      private fb: FormBuilder,
      private http: HttpClient
  ) {}

  ngOnInit(){
    this.forms = this.fb.group({
        fname: [""],
        mname: [""],
        lname: [""],
        gender: [""]
    });
      this.GetAllStudent();
  }

  GetAllStudent(){
      this.http.get("http://localhost/Cive_forum/api/src/public/endpoints/all_students")
          .subscribe((result : any)=>{
              this.students = result.data;
              console.log(result.data);
          })

  }

  submit(form){
      this.http.post("http://localhost/Cive_forum/api/src/public/endpoints/create_student",form)
          .subscribe((result : any)=>{
              console.log(result);
              this.GetAllStudent();
              this.forms.reset()
          })
  }

  delete(id:number){
      this.http.delete("http://localhost/Cive_forum/api/src/public/endpoints/delete_student/"+id)
          .subscribe((result : any)=>{
              console.log(result);
              this.GetAllStudent();
          })
  }
}
