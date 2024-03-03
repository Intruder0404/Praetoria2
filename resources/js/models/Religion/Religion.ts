import {ReligionAttributeValue} from "@/models/Religion/ReligionAttributeValue";

export interface IReligion {
    id?: number;
    name?: string;
    type?: string;
    isActive?: boolean;
    createdAt?: Date;
    updatedAt?: Date | null;
}

export class Religion implements IReligion {
    id?: number;
    name?: string;
    type?: string;
    isActive?: boolean;
    createdAt?: Date;
    updatedAt?: Date | null;

    constructor(
        religion:{
            id: number,
            name: string,
            type: string,
            isActive: boolean,
            createdAt: Date,
            updatedAt: Date | null
        }
    ) {
        if(religion){
            this.id = religion.id ? religion.id : 0;
            this.name = religion.name ? religion.name : '';
            this.type = religion.type ? religion.type : '';
            this.isActive = religion.isActive ? religion.isActive : false;
            this.createdAt = religion.createdAt ? religion.createdAt : new Date();
            this.updatedAt = religion.updatedAt ? religion.updatedAt : null;
        }
    }

}
