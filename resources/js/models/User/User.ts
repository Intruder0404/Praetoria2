// @ts-ignore
import {UserAttribute, UserAttributeValue} from "@/models";
import {Rank} from "@/models/User/Rank";
import {Type} from "@/models/User/Type";

export interface IUser {
  id: number;
  username?: string;
  first_name?: string;
  last_name?: string;
  email?: string;
  type?: number;
  characters: any[];
  user_rank?: Rank;
  user_type?: Type;
}

export class User implements IUser {
  id: number;
  username?: string;
  first_name?: string;
  last_name?: string;
  email?: string;
  type?: number;
  characters: any[];
  user_rank?: Rank;
  user_type?: Type;
  isActive?: boolean;

  constructor(user?: {
    id?: number,
    username?: string,
    first_name?: string,
    last_name?: string,
    type?: number,
    email?: string,
    characters: any[];
    user_rank?: Rank,
    user_type?: Type,
    isActive?: boolean
  }) {
      if(user){
          this.id = user.id ? user.id : 0;
          this.username = user.username ? user.username : '';
          this.first_name = user.first_name ? user.first_name : '';
          this.last_name = user.last_name ? user.last_name : '';
          this.type = user.type ? user.type : null;
          this.email = user.email ? user.email : '';
          this.characters = user.characters ? user.characters : [];
          this.user_rank = user.user_rank ? new Rank(user.user_rank) : null;
          this.user_type = user.user_type ? new Type(user.user_type) : null;
          this.isActive = user.isActive ? user.isActive : null;
      }
  }

}
