export function convertBrazilianDateToDate(dateStr: string): Date | null {
  const dateRegex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;

  const match = dateStr.match(dateRegex);

  if (!match) {
    return null;
  }

  const day = parseInt(match[1], 10);
  const month = parseInt(match[2], 10) - 1;
  const year = parseInt(match[3], 10);

  const date = new Date(year, month, day);

  if (isNaN(date.getTime())) {
    return null;
  }

  return date;
}
