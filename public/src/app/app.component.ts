import { Component } from '@angular/core';
import { HttpModule } from '@angular/http';
import { QuestionService } from './questions.service';


@Component({
  selector: 'my-app',
  templateUrl: 'app/app.html',
  providers : [ QuestionService ]
})
export class AppComponent  { 

	constructor(
		private questionService: QuestionService;
	){}

	name = 'Angular'; 

}
