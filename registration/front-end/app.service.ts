import {Injectable} from "@angular/core";
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from './classes/user';

@Injectable()
export class AppService {
    url: string = 'http://dipishmotapi/web/';

    constructor(private http: HttpClient) { }

    registerUser (user: User) {
        const httpOptions = {
            headers: new HttpHeaders({
                'Content-Type':  'application/json',
            })
        };
        const body = {
            email: user.email,
            password: user.password,
            isShopOwner: user.isShopOwner,
        };
        return this.http.post(this.url + 'users', body, httpOptions);
    }
}