export class Comment {
	constructor(
		public id: number,
		public title: string,
		public content: string,
		public created_at: Date,
		public updated_at: Date,
		public author: string
	){}
}