import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Question } from 'models/question';
import { Observable } from 'rxjs/Rx';

//import RxJs required methods
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

@Injectable()
export class QuestionService {

	constructor(private http: Http)
	{

	}

	private questionsUrl = "http://localhost:8000/api/post";

	getQuestions() : Observable<Question[]> {

		return this.http.get(this.questionsUrl)
				.map((res.Response) => res.json())
				.catch((error:any) => Observable.throw(error.json().error || 'Server error...'))

	}


}