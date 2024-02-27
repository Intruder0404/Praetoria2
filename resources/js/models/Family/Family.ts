import {FamilyAttributeValue} from "@/models/Family/FamilyAttributeValue";

export interface IFamily {
  id: number;
  name?: string;
  type?: string;
  isActive?: boolean;
  createdAt?: Date;
  updatedAt?: Date | null;
}

export class Family implements IFamily {
  id: number;
  name?: string;
  type?: string;
  isActive?: boolean;
  createdAt?: Date;
  updatedAt?: Date | null;

  constructor(
      family:{
          id?: number,
          name?: string,
          type?: string,
          isActive?: boolean,
          createdAt?: Date,
          updatedAt?: Date | null,
      }
  ) {
    this.id = family.id ? family.id : 0;
    this.name = family.name ? family.name : '';
    this.type = family.type ? family.type : '';
    this.isActive = family.isActive ? family.isActive : false;
    this.createdAt = family.createdAt ? family.createdAt : new Date();
    this.updatedAt = family.updatedAt ? family.updatedAt : null;
  }

}
