// @ts-ignore
import {Rank} from "@/models/User/Rank";
import {Family} from "@/models//Family/Family";
import {Religion} from "@/models//Religion/Religion";
import {Guild} from "@/models/Guild/Guild";

export interface ICharacter {
    id: number;
    user_id: number;
    name?: string;
    isActive?: boolean;
    rank?: Rank;
    rank_id?: number;
    family?: Family;
    family_id?: number;
    religion?: Religion;
    religion_id?: number;
    guild?: Guild;
    guild_id?: number;
}

export class Character implements ICharacter {
    id: number;
    user_id: number;
    name?: string;
    isActive?: boolean;
    rank?: Rank;
    rank_id?: number;
    family?: Family;
    family_id?: number;
    religion?: Religion;
    religion_id?: number;
    guild?: Guild;
    guild_id?: number;

    constructor(character?: {
        id?: number,
        user_id?: number,
        name?: string,
        isActive?: boolean,
        rank?: Rank,
        rank_id?: number,
        family?: Family,
        family_id?: number,
        religion?: Religion,
        religion_id?: number,
        guild?: Guild,
        guild_id?: number
    }) {
        if(character){
            this.id = character.id ? character.id : 0;
            this.user_id = character.user_id ? character.user_id : 0;
            this.name = character.name ? character.name : '';
            this.isActive = character.isActive ? character.isActive : null;
            this.rank = character.rank ? new Rank(character.rank) : null;
            this.rank_id = character.rank_id ? character.rank_id : null;
            this.family = character.family ? new Family(character.family) : null;
            this.family_id = character.rank_id ? character.family_id: null;
            this.rank = character.rank ? new Rank(character.rank) : null;
            this.rank_id = character.rank_id ? character.rank_id: null;
            this.guild = character.guild ? new Guild(character.guild) : null;
            this.guild_id = character.rank_id ? character.rank_id: null;
        }
    }

}
