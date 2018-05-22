import { Component, OnInit } from '@angular/core';
import {AppService} from "../app.service";
import {User} from '../classes/user';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  providers: [AppService]
})

export class RegisterComponent implements OnInit {
    titleText: string;
    bodyText: string;
    user: User = new User();

    changeType(entry): void {
        this.user.isShopOwner = entry;
    }


    constructor(private appService: AppService) { }

    submit(user: User) {
        this.appService.registerUser(user)
            .subscribe(
                (data: User) => {
                    this.titleText = 'Успешная регистрация';
                    this.bodyText = 'Поздравляем вас с успешной регистрацией в нашем сервисе! Для входа в аккаунт\n' +
                        'используйте ваш e-mail.';
                },
                error => {
                    if (error.error[0] && error.error[0].field === 'email') {
                        this.titleText = 'Данный e-mail уже используется';
                        this.bodyText = 'Введенный вами e-mail уже используется в системе. Попробуйте зарегистрироваться' +
                            ' с помощью другого почтового адреса или войдите в систему, используя введенный e-mail.';
                    } else {
                        this.titleText = 'Упс, что-то пошло не так';
                        this.bodyText =  'Пожалуйста, повторите попытку.';
                    }
                }
            );
    }

    ngOnInit() {}

}
