export class Task {
    title: string;
    author: string;
    priority: Priority;

    constructor(title: string, author: string, priority: Priority) {
        this.title = title;
        this.author = author;
        this.priority = priority;
    }
}

export enum Priority {
    LOW,
    MEDIUM,
    HIGH
}

export class PresetRoom {
    id: string;
    name: string;
    constructor(id: string, name: string) {
        this.id = id;
        this.name = name;
    }
}