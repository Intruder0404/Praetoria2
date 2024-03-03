export interface IKingdom {
  id?: number;
  name?: string;
  type?: string;
  isActive?: boolean;
  createdAt?: Date;
  updatedAt?: Date | null;
}

export class Kingdom implements IKingdom {
  id?: number;
  name?: string;
  type?: string;
  isActive?: boolean;
  createdAt?: Date;
  updatedAt?: Date | null;

  constructor(
      kingdom?:{
          id?: number,
          name?: string,
          type?: string,
          isActive?: boolean,
          createdAt?: Date,
          updatedAt?: Date | null
      }
  ) {
    this.id = kingdom.id ? kingdom.id : 0;
    this.name = kingdom.name ? kingdom.name : '';
    this.type = kingdom.type ? kingdom.type : '';
    this.isActive = kingdom.isActive ? kingdom.isActive : false;
    this.createdAt = kingdom.createdAt ? kingdom.createdAt : new Date();
    this.updatedAt = kingdom.updatedAt ? kingdom.updatedAt : null;
  }

}
