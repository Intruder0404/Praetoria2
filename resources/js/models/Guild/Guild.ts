import {GuildAttributeValue} from "@/models/Guild/GuildAttributeValue";
import {Kingdom} from "@/models/Kingdom/Kingdom";

export interface IGuild {
    id?: number;
    name?: string;
    type?: string;
    description?: string;
    isActive?: boolean;
    createdAt?: Date;
    updatedAt?: Date | null;
    kingdom?: Kingdom;
    kingdom_id?: number;
}

export class Guild implements IGuild {
    id?: number;
    name?: string;
    type?: string;
    description?: string;
    isActive?: boolean;
    createdAt?: Date;
    updatedAt?: Date | null;
    kingdom?: Kingdom;
    kingdom_id?: number;

    constructor(
        guild?: {
            id?: number,
            name?: string,
            type?: string,
            isActive?: boolean,
            description?: string,
            kingdom?: Kingdom,
            kingdom_id?: number,
            createdAt?: Date,
            updatedAt?: Date | null,
        }
    ) {
        if (guild) {
            this.id = guild.id ? guild.id : 0;
            this.name = guild.name ? guild.name : '';
            this.type = guild.type ? guild.type : '';
            this.isActive = guild.isActive ? guild.isActive : false;
            this.description = guild.description ? guild.description : '';
            this.kingdom = guild.kingdom ? new Kingdom(guild.kingdom) : null;
            this.kingdom_id = guild.kingdom_id ? guild.kingdom_id : null;
            this.createdAt = guild.createdAt ? guild.createdAt : new Date();
            this.updatedAt = guild.updatedAt ? guild.updatedAt : null;
        }
    }

}
