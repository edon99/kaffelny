
export function serviceLabel(service: number): string {
    switch (service) {
        case 1:
            return 'Baby Sitting';
        case 2:
            return 'Elder Care';
        case 3:
            return 'Health Care';
            default:
                return 'Unknown';
    }
}

export function serviceColor(service: number): string {
    switch (service) {
        case 1:
            return 'bg-blue-500 p-1 rounded-lg';
        case 2:
            return 'bg-green-500 p-1 rounded-lg';
        case 3:
            return 'bg-yellow-500 p-1 rounded-lg';
        default:
            return 'bg-gray-500 p-1 rounded-lg';
    }}
