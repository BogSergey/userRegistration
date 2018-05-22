import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { HttpModule } from "@angular/http";
import { AdminQueriesComponent } from './admin-queries/admin-queries.component';
import { AdminSettingsComponent } from './admin-settings/admin-settings.component';
import { AdminSuggestionsComponent } from './admin-suggestions/admin-suggestions.component';
import { LoginComponent } from './login/login.component';
import { RegisterShopComponent } from './register-shop/register-shop.component';
import { ShopComponent } from './shop/shop.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { UserQueriesComponent } from './user-queries/user-queries.component';
import { UserQueryDetailsComponent } from './user-query-details/user-query-details.component';
import { UserSuggestionsComponent } from './user-suggestions/user-suggestions.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { IndexComponent } from './index/index.component';
import { RouterModule } from "@angular/router";
import { APP_BASE_HREF } from '@angular/common';
import { HttpClient, HttpClientModule } from "@angular/common/http";
import { FormsModule } from '@angular/forms';
import { RegisterComponent } from './register/register.component';

const routes = [
    {path: '', component: IndexComponent},
    {path: 'adminQueries', component: AdminQueriesComponent},
    {path: 'adminSettings', component: AdminSettingsComponent},
    {path: 'adminSuggestions', component: AdminSuggestionsComponent},
    {path: 'login', component: LoginComponent},
    {path: 'registerShop', component: RegisterShopComponent},
    {path: 'shop', component: ShopComponent},
    {path: 'userProfile', component: UserProfileComponent},
    {path: 'userQueries', component: UserQueriesComponent},
    {path: 'userQueryDetails', component: UserQueryDetailsComponent},
    {path: 'userSuggestions', component: UserSuggestionsComponent},
    {path: 'register', component: RegisterComponent}
];

@NgModule({
  declarations: [
    AppComponent,
    AdminQueriesComponent,
    AdminSettingsComponent,
    AdminSuggestionsComponent,
    LoginComponent,
    RegisterShopComponent,
    ShopComponent,
    UserProfileComponent,
    UserQueriesComponent,
    UserQueryDetailsComponent,
    UserSuggestionsComponent,
    HeaderComponent,
    FooterComponent,
    IndexComponent,
    RegisterComponent
  ],
  imports: [
    BrowserModule,
    HttpModule,
    RouterModule.forRoot(routes),
    HttpClientModule,
    FormsModule
  ],
  providers: [{provide: APP_BASE_HREF, useValue : '/' }],
  bootstrap: [AppComponent]
})
export class AppModule {
}
